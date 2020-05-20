<?php

namespace League\OAuth2\Client\Provider;

class DlrgUser implements ResourceOwnerInterface {
    /**
     * @var array
     */
    protected $data;

    /**
     * @param array $response
     */
    public function __construct(array $response) {
        $this->data = $response;
    }

    /**
     * Returns the ID for the user as a string if present.
     *
     * @return string|null
     */
    public function getId() {
        return $this->getField('sub');
    }

    /**
     * Returns the name for the user as a string if present.
     *
     * @return string|null
     */
    public function getName() {
        return $this->getField('name');
    }

    /**
     * Returns the first name for the user as a string if present.
     *
     * @return string|null
     */
    public function getFirstName() {
        return $this->getField('given_name');
    }

    /**
     * Returns the last name for the user as a string if present.
     *
     * @return string|null
     */
    public function getLastName() {
        return $this->getField('family_name');
    }

    /**
     * Returns the email for the user as a string if present.
     *
     * @return string|null
     */
    public function getEmail() {
        return $this->getField('email');
    }

    /**
     * Returns if the user's email has been verified
     *
     * @return boolean
     */
    public function isEmailVerified() {
        return !!$this->getField('email_verified');
    }

    /**
     * Returns the preferred username for the user as a string if present.
     *
     * @return string|null
     */
    public function getPreferredUsername() {
        return $this->getField('preferred_username');
    }

    /**
     * Returns all the data obtained about the user.
     *
     * @return array
     */
    public function toArray() {
        return $this->data;
    }

    /**
     * Returns a field from the Graph node data.
     *
     * @param string $key
     *
     * @return mixed|null
     */
    private function getField($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }
}
