<?php

namespace App;

class FuelReceiptDTO
{
    public function __construct(
        public string $licencePlate,
        public string $dateTime,
        public string $odometer,
        public string $petrolStation,
        public string $fuelType,
        public string $refueled,
        public string $total,
        public string $currency,
        public string $fuelPrice
    )
    {
    }






    public function toArray(): array
    {
        return [
            'licencePlate' => $this->licencePlate,
            'dateTime' => $this->dateTime,
            'odometer' => $this->odometer,
            'petrolStation' => $this->petrolStation,
            'fuelType' => $this->fuelType,
            'refueled' => $this->refueled,
            'total' => $this->total,
            'currency' => $this->currency,
            'fuelPrice' => $this->fuelPrice,
        ];
    }

}