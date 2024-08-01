<?php

namespace CTApi\Models\Events\Service;

class ServiceFromServiceGroupBuilder
{
    private int $serviceGroupId;

    public function __construct(int $serviceGroupId)
    {
        $this->serviceGroupId = $serviceGroupId;
    }

    /**
     * @return Service[]
     */
    public function get(): array
    {
        $allServices = ServiceRequest::all();
        $selectedServices = [];

        foreach ($allServices as $service) {
            if ($service->getServiceGroupId() == $this->serviceGroupId) {
                $selectedServices[] = $service;
            }
        }
        return $selectedServices;
    }
}
