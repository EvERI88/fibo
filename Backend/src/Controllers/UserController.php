<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use App\Request\UserAuthRequest;
use App\Request\UserRegisterRequest;
use App\Request\UserTokenRequest;
use DateTime;
use DateTimeImmutable;
use Phalcon\Encryption\Security;
use Phalcon\Encryption\Security\JWT\Builder;
use Phalcon\Encryption\Security\JWT\Signer\Hmac;
use Phalcon\Encryption\Security\JWT\Token\Parser;
use Phalcon\Encryption\Security\JWT\Validator;
use Firebase\JWT\JWT;

class UserController extends BaseController
{
    public function register(): array
    {
        $registerValidate = new UserRegisterRequest($this->request);
        $data = $registerValidate->getData();
        $security = new Security();
        $data['password'] = $security->hash((string)$data['password']);

        $user = new User();

        if (!empty($registerValidate->getErrors())) {
            return [
                'status' => 'error',
                'message' => 'Ошибка регистрации',
                'error' => $registerValidate->getErrors(),
            ];
        }

        $user->assign($data);

        if ($user->create()) {
            return [
                'status' => 'success',
                'message' => 'Регистрация прошла успешно',
                'user' => (object)[
                    'id' =>  $user->id,
                    'name' =>  $user->name,
                    'telephone' =>  $user->telephone,
                    'is_admin' =>  $user->is_admin,
                ]
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Ошибка при регистрации',
                'errors' => $user->getMessages()
            ];
        }
    }
    public function authorization(): mixed
    {
        $authValidate = new UserAuthRequest($this->request);
        $data = $authValidate->getData();

        $security = new Security();

        if (!empty($authValidate->getErrors())) {
            return [
                'status' => 'error',
                'message' => 'Ошибка авторизации',
                'error' => $authValidate->getErrors(),
            ];
        }

        $user = User::findFirst(
            [
                'conditions' => 'telephone = :telephone:',
                'bind'       => [
                    'telephone' => (string)$data['telephone']
                ]
            ]
        );

        $signer  = new Hmac();
        $builder = new Builder($signer);

        $now = new DateTime();
        $issued = $now->getTimestamp();
        $notBefore = $now->modify('-1 minute')->getTimestamp();
        $expires = $now->modify('+1 day')->getTimestamp();
        $passphrase = $user->password;
        if ($user) {
            $check = $security->checkHash((string)$data['password'], $user->password);
            if ($check) {
                $user->assign($data);
                if ($user) {
                    $builder
                        ->setAudience('http://api.fibo.local/user/auth')
                        ->setContentType('application/json')
                        ->setExpirationTime($expires)
                        ->setId((string)$user->id)
                        ->setIssuedAt($issued)
                        ->setIssuer('http://api.fibo.local')
                        ->setNotBefore($notBefore)
                        ->setSubject((string)$user->id)
                        ->setPassphrase($passphrase);

                    $tokenObject = $builder->getToken();
                    return [
                        'status' => 'success',
                        'message' => 'Успешно вошли',
                        'data' => $user,
                        'token' => $tokenObject->getToken()
                    ];
                } else {
                    return [
                        'status' => 'error',
                        'message' => 'Ошибка при авторизации',
                        'errors' => $user->getMessages()
                    ];
                }
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Проблема с проверкой хэша',
                    'errors' => $user->getMessages()
                ];
            }
        } else {
            return [
                'status' => 'error',
                'message' => 'Попробуйте еще раз',
                'error' => (object)['try_again' => 'Попробуйте еще раз']
            ];
        }
    }
    public function checkToken(): array
    {
        $tokenValidate = new UserTokenRequest($this->request);
        $data = $tokenValidate->getData();
        $token = $data['token'];

        if (!$token) {
            return [
                'Auth' => 'no authorization',
            ];
        }

        $user = User::findFirst(
            [
                'conditions' => 'id = :id:',
                'bind'       => [
                    'id' => (int)$data['id']
                ]
            ]
        );

        if ($user) {
            $parser = new Parser();

            $tokenObject = $parser->parse($token);

            $tokenReceived = $token;
            $audience      = 'http://api.fibo.local/user/auth';
            $now           = new DateTimeImmutable();
            $issued        = $now->getTimestamp();
            $notBefore     = $now->modify('-1 minute')->getTimestamp();
            $expires       = $now->getTimestamp();
            $id            = (string)$user->id;
            $issuer        = 'http://api.fibo.local';

            // Defaults to 'sha512'
            $signer     = new Hmac();
            $passphrase = $user->password;

            $validator = new Validator($tokenObject, 100);

            $validator
                ->validateAudience($audience)
                ->validateExpiration($expires)
                ->validateId($id)
                ->validateIssuedAt($issued)
                ->validateIssuer($issuer)
                ->validateNotBefore($notBefore)
                ->validateSignature($signer, $passphrase);

            if ($validator->getErrors()) {
                return [
                    'token-status' => 'no-valid'
                ];
            } else {
                return [
                    'token-status' => $token,
                ];
            }
        } else {
            return [
                'status' => 'error',
                'message' => 'Пользователь не найден',
            ];
        }
    }
}
