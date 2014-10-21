<?php
/**
 * EAuthUserIdentity class file.
 *
 * @author Maxim Zemskov <nodge@yandex.ru>
 * @link http://code.google.com/p/yii-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * EAuthUserIdentity is a base user Identity class to authenticate with EAuth.
 * @package application.extensions.eauth
 */
class EAuthUserIdentity extends CBaseUserIdentity {
	const ERROR_NOT_AUTHENTICATED = 3;

	/**
	 * @var EAuthServiceBase the authorization service instance.
	 */
	protected $_service;
	
	/**
	 * @var string the unique identifier for the identity.
	 */
	protected $_id;
	
	/**
	 * @var string the display name for the identity.
	 */
	protected $_name;
	
	/**
	 * Constructor.
	 * @param EAuthServiceBase $service the authorization service instance.
	 */
	public function __construct($service) {
		$this->_service = $service;
	}
	
	/**
	 * Authenticates a user based on {@link service}.
	 * This method is required by {@link IUserIdentity}.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate() {		
		if ($this->_service->isAuthenticated) {
			$this->_name = $this->_service->getAttribute('name');

            // Check for exist user_network
            if ($socialUser = SocialNetworkUser::model()->findByAttributes(array('network_id'=>$this->_service->serviceName,'social_network_user_id'=>$this->_service->id)))
            {
                $this->_id = $socialUser->user->id;
                $this->_name = $socialUser->user->username;
            } else {
                $user = new User();
                $user->username = $this->_name;
                $user->password = User::generateRandomString();
                $user->status = User::STATUS_ACTIVE;
                $user->role = 'user';
                $user->save(false);
                $this->_id = $user->id;
                $profile = new Profile();
                $profile->user_id = $user->id;
                $profile->save(false);
                $socialUser = new SocialNetworkUser();
                $socialUser->user_id = $user->id;
                $socialUser->network_id = $this->_service->serviceName;
                $socialUser->social_network_user_id = $this->_service->id;
                $socialUser->username = $this->_name;
                $socialUser->save(false);
            }
            $this->errorCode = self::ERROR_NONE;
		}
		else {
			$this->errorCode = self::ERROR_NOT_AUTHENTICATED;
		}
		return !$this->errorCode;
	}

	/**
	 * Returns the unique identifier for the identity.
	 * This method is required by {@link IUserIdentity}.
	 * @return string the unique identifier for the identity.
	 */
	public function getId() {
		return $this->_id;
	}

	/**
	 * Returns the display name for the identity.
	 * This method is required by {@link IUserIdentity}.
	 * @return string the display name for the identity.
	 */
	public function getName() {
		return $this->_name;
	}
}