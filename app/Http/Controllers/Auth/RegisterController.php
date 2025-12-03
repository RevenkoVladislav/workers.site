<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\WorkerStoreUpdateService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected WorkerStoreUpdateService $workerService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(WorkerStoreUpdateService $workerService)
    {
        $this->middleware('guest');
        $this->workerService = $workerService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:60'],
            'surname' => ['nullable', 'string', 'max:90'],
            'age' => ['nullable', 'integer', 'between:18,100'],
            'phone' => ['required', 'string', 'regex:/^8[0-9]{10}$/', 'unique:workers,phone'],
            'description' => ['nullable', 'string'],
            'is_married' => ['nullable', 'boolean'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = $this->workerService->store($data);
        return $user;
    }
}
