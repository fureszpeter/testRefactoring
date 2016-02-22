<?php
namespace Language\Domain\ValueObjects;

use Furesz\TypeChecker\TypeChecker;
use JsonSerializable;
use UnexpectedValueException;

/**
 * Valid API response.
 *
 * @package Language
 *
 * @license Proprietary
 */
class ApiResponse implements JsonSerializable
{
    const STATUS_VALID = 'OK';
    const STATUS_INVALID = 'ERROR';

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $data;

    /**
     * @param string $status
     * @param mixed $data
     *
     * @throws \InvalidArgumentException If status is not a string.
     * @throws \UnexpectedValueException If status is invalid.
     */
    public function __construct($status, $data)
    {
        $this
            ->setStatus($status)
            ->setData($data);
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @throws \InvalidArgumentException If status is not a string.
     * @throws \UnexpectedValueException If status is invalid.
     *
     * @return $this
     */
    private function setStatus($status)
    {
        TypeChecker::assertString($status, '$status');

        if (!in_array($status, [self::STATUS_VALID, self::STATUS_INVALID])) {
            throw new UnexpectedValueException(
                sprintf('Invalid status provided! Status: %s', $status)
            );
        }

        $this->status = $status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->getStatus() === self::STATUS_VALID;
    }

    /**
     * @throws \UnexpectedValueException If API response contains error.
     */
    public function validateApiResponse()
    {
        if (! $this->isValid()) {
            throw new UnexpectedValueException('API response contains error!');
        }
    }

    /**
     * @param mixed $data
     *
     * @return $this
     */
    private function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     *  @return array
     */
    public function jsonSerialize()
    {
        return [
            'status' => $this->getStatus(),
            'data' => $this->getData(),
        ];
    }
}
