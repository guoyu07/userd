<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace Controller;


use FastD\Http\Response;
use FastD\Http\ServerRequest;
use Services\Password;

/**
 * Class UserController
 * @package Controller
 */
class UserController
{
    /**
     * @param ServerRequest $request
     * @return \FastD\Http\JsonResponse
     */
    public function findUsers(ServerRequest $request)
    {
        $query = $request->getQueryParams();
        $page = isset($query['p']) ? $query['p'] : 1;

        $profile = model('user')->findUsers($page);

        return json($profile);
    }

    /**
     * @param ServerRequest $request
     * @return \FastD\Http\JsonResponse
     */
    public function findUser(ServerRequest $request)
    {
        $user = model('user')->findUser($request->getAttribute('user'));

        return json($user);
    }

    /**
     * @param ServerRequest $request
     * @return \FastD\Http\JsonResponse
     */
    public function createUser(ServerRequest $request)
    {
        $user = model('user');

        $data = $request->getParsedBody();

        $data['password'] = Password::hash($data['password']);

        $user->createUser($data);

        return json($request->getParsedBody());
    }

    /**
     * @param ServerRequest $request
     * @return \FastD\Http\JsonResponse
     */
    public function patchUser(ServerRequest $request)
    {
        $user = model('user');

        parse_str($request->getBody(), $data);

        $data['password'] = Password::hash($data['password']);

        $user->patchUser($request->getAttribute('user'), $data);

        return json($request->getParsedBody());
    }

    /**
     * @param ServerRequest $request
     * @return \FastD\Http\JsonResponse
     */
    public function deleteUser(ServerRequest $request)
    {
        $id = $request->getAttribute('id');

        $profile = model('profile')->deleteUser($id);

        return json($profile, Response::HTTP_NO_CONTENT);
    }
}