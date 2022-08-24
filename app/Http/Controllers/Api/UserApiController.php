<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Resources\DomainResource;
use App\Http\Resources\ShopResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;


class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        return Admin::getCollection(User::query(), ['name', 'email'], $request, UserResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $user = User::create($request->validated());

//        if(!empty($request->roles)) {
//            foreach ($request->roles as $role_name) {
//                $role = Role::where('name', $role_name);
//
//                if($role->exists()) {
//                    $user->roles()->attach($role->first()->id);
//                }
//            }
//        }

        return response()->json(new UserResource($user));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return response()->json(new UserResource($user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(Request $request, User $user): JsonResponse
    {
        $user->update($request->validated());

        if($request->has('roles')) {
            $user->roles()->detach();

            foreach ($request->roles as $role_name) {
                $role = Role::where('name', $role_name)->firstOrFail();
                $user->roles()->save($role);
            }
        }

        return response()->json(new UserResource($user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json(new UserResource($user));
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json(new UserResource($request->user()));
    }

    public function shops(Request $request): JsonResponse
    {
        return response()->json(ShopResource::collection($request->user()->shops->load('domain')));
    }

    public function domains(Request $request): JsonResponse
    {
        return response()->json(DomainResource::collection($request->user()->domains));
    }

    public function refresh(Request $request): UserResource
    {
        $token = PersonalAccessToken::findToken($request->token);

        return $token ? new UserResource($token->tokenable) : abort(401);
    }

    public function getApiToken(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken($request->email)->plainTextToken;
    }

    public function getMe(Request $request): UserResource
    {
        $token = PersonalAccessToken::findToken($request->token);
        return new UserResource($token->tokenable);
    }

    public function block(User $user) {
        $user->block()->save();

        return response()->json(new UserResource($user));
    }

    public function unblock(User $user) {
        $user->unblock()->save();

        return response()->json(new UserResource($user));
    }

    public function changePassword(Request $request) {
        abort_unless($request->has('old_password'), Response::HTTP_BAD_REQUEST, 'Старый пароль неверный');
        abort_unless($request->has('new_password'), Response::HTTP_BAD_REQUEST, 'Новый пароль неверный');
        abort_unless($request->has('new_password_again'), Response::HTTP_BAD_REQUEST, 'Пароли не совпадают');

        $user = $request->user();

        $incorrect_password = Hash::check($request->old_password, $user->password);
        $new_password_confirmed = $request->new_password === $request->new_password_again;

        abort_unless($incorrect_password, Response::HTTP_BAD_REQUEST, 'Старый пароль неверный');
        abort_unless($new_password_confirmed, Response::HTTP_BAD_REQUEST, 'Пароли не совпадают');

        $user->password = Hash::make($request->new_password);
        $user->saveQuietly();

        return response()->json();
    }

    public function updateData(Request $request) {
        abort_unless($request->has('email'), Response::HTTP_BAD_REQUEST, 'Некорректное значение для поля почта');

        $user = $request->user();

        $user->name = $request->name;
        $user->email = $request->email;

        $user->saveQuietly();

        return response()->json();
    }
}
