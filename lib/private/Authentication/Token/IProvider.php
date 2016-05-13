<?php

/**
 * @author Christoph Wurst <christoph@owncloud.com>
 *
 * @copyright Copyright (c) 2016, ownCloud, Inc.
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

namespace OC\Authentication\Token;

use OC\Authentication\Exceptions\InvalidTokenException;
use OCP\IUser;

interface IProvider {

	/**
	 * Create and persist a new token
	 *
	 * @param string $token
	 * @param string $uid
	 * @param string $password
	 * @param string $name
	 * @param int $type token type
	 * @return DefaultToken
	 */
	public function generateToken($token, $uid, $password, $name, $type = IToken::TEMPORARY_TOKEN);

	/**
	 * Get a token by token id
	 *
	 * @param string $tokenId
	 * @throws InvalidTokenException
	 * @return IToken
	 */
	public function getToken($tokenId) ;
	
	/**
	 * @param string $token
	 * @throws InvalidTokenException
	 * @return IToken
	 */
	public function validateToken($token);

	/**
	 * Invalidate (delete) the given session token
	 *
	 * @param string $token
	 */
	public function invalidateToken($token);

	/**
	 * Update token activity timestamp
	 *
	 * @param IToken $token
	 */
	public function updateToken(IToken $token);

	/**
	 * Get all token of a user
	 *
	 * The provider may limit the number of result rows in case of an abuse
	 * where a high number of (session) tokens is generated
	 *
	 * @param IUser $user
	 * @return IToken[]
	 */
	public function getTokenByUser(IUser $user);

	/**
	 * Get the (unencrypted) password of the given token
	 *
	 * @param IToken $token
	 * @param string $tokenId
	 * @return string
	 */
	public function getPassword(IToken $token, $tokenId);
}