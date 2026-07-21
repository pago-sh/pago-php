<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerSeat
 */
final class CustomerSeat implements Model, Deserializable
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        /**
         * @var string|null
         */
        public readonly ?string $subscription_id,
        /**
         * @var string|null
         */
        public readonly ?string $order_id,
        public readonly SeatStatus $status,
        /**
         * @var string|null
         */
        public readonly ?string $customer_id,
        /**
         * @var string|null
         */
        public readonly ?string $member_id,
        /**
         * @var Member|null
         */
        public readonly ?Member $member,
        /**
         * @var string|null
         */
        public readonly ?string $email,
        /**
         * @var string|null
         */
        public readonly ?string $customer_email,
        /**
         * @var string|null
         */
        public readonly ?string $invitation_token_expires_at,
        /**
         * @var string|null
         */
        public readonly ?string $claimed_at,
        /**
         * @var string|null
         */
        public readonly ?string $revoked_at,
        /**
         * @var array<string, mixed>|null
         */
        public readonly ?array $seat_metadata,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $created_at = Json::toString(Json::get($data, 'created_at'));
        /** @var string|null $modified_at */
        $modified_at = (Json::get($data, 'modified_at') === null ? null : Json::toString(Json::get($data, 'modified_at')));
        $id = Json::toString(Json::get($data, 'id'));
        /** @var string|null $subscription_id */
        $subscription_id = (Json::get($data, 'subscription_id') === null ? null : Json::toString(Json::get($data, 'subscription_id')));
        /** @var string|null $order_id */
        $order_id = (Json::get($data, 'order_id') === null ? null : Json::toString(Json::get($data, 'order_id')));
        $status = SeatStatus::from(Json::toString(Json::get($data, 'status')));
        /** @var string|null $customer_id */
        $customer_id = (Json::get($data, 'customer_id') === null ? null : Json::toString(Json::get($data, 'customer_id')));
        /** @var string|null $member_id */
        $member_id = (Json::get($data, 'member_id') === null ? null : Json::toString(Json::get($data, 'member_id')));
        /** @var Member|null $member */
        $member = (Json::get($data, 'member') === null ? null : Member::fromArray(Json::toMap(Json::get($data, 'member'))));
        /** @var string|null $email */
        $email = (Json::get($data, 'email') === null ? null : Json::toString(Json::get($data, 'email')));
        /** @var string|null $customer_email */
        $customer_email = (Json::get($data, 'customer_email') === null ? null : Json::toString(Json::get($data, 'customer_email')));
        /** @var string|null $invitation_token_expires_at */
        $invitation_token_expires_at = (Json::get($data, 'invitation_token_expires_at') === null ? null : Json::toString(Json::get($data, 'invitation_token_expires_at')));
        /** @var string|null $claimed_at */
        $claimed_at = (Json::get($data, 'claimed_at') === null ? null : Json::toString(Json::get($data, 'claimed_at')));
        /** @var string|null $revoked_at */
        $revoked_at = (Json::get($data, 'revoked_at') === null ? null : Json::toString(Json::get($data, 'revoked_at')));
        /** @var array<string, mixed>|null $seat_metadata */
        $seat_metadata = (Json::get($data, 'seat_metadata') === null ? null : Json::toMap(Json::get($data, 'seat_metadata')));

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            subscription_id: $subscription_id,
            order_id: $order_id,
            status: $status,
            customer_id: $customer_id,
            member_id: $member_id,
            member: $member,
            email: $email,
            customer_email: $customer_email,
            invitation_token_expires_at: $invitation_token_expires_at,
            claimed_at: $claimed_at,
            revoked_at: $revoked_at,
            seat_metadata: $seat_metadata,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['created_at'] = Json::encode($this->created_at);
        $data['modified_at'] = Json::encode($this->modified_at);
        $data['id'] = Json::encode($this->id);
        $data['subscription_id'] = Json::encode($this->subscription_id);
        $data['order_id'] = Json::encode($this->order_id);
        $data['status'] = Json::encode($this->status);
        $data['customer_id'] = Json::encode($this->customer_id);
        $data['member_id'] = Json::encode($this->member_id);
        $data['member'] = Json::encode($this->member);
        $data['email'] = Json::encode($this->email);
        $data['customer_email'] = Json::encode($this->customer_email);
        $data['invitation_token_expires_at'] = Json::encode($this->invitation_token_expires_at);
        $data['claimed_at'] = Json::encode($this->claimed_at);
        $data['revoked_at'] = Json::encode($this->revoked_at);
        $data['seat_metadata'] = Json::encode($this->seat_metadata);

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}