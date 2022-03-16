<?php

namespace App\Service\MedicalSpecialty;

use App\Entity\MedicalSpecialty;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MedicalSpecialtyService
{
    private const CACHE_KEY = 'medical_specialties';
    private const CACHE_EXPIRATION_TIME = 600;

    private EntityManagerInterface $entityManager;

    private AdapterInterface $cache;

    private array $result = [];

    public function __construct(EntityManagerInterface $entityManager, AdapterInterface $cache)
    {
        $this->entityManager = $entityManager;
        $this->cache = $cache;
    }

    public function getMedicalSpecialties(): array
    {
        if ($this->isCached()) {
            return $this->getCachedResult();
        }

        $this->handleCachingResults();

        return $this->result;
    }

    private function isCached(): bool
    {
        return $this->cache->getItem(md5(self::CACHE_KEY))->isHit();
    }

    private function getCachedResult(): array
    {
        return $this->cache->getItem(md5(self::CACHE_KEY))->get();
    }

    private function handleCachingResults(): void
    {
        /** @var MedicalSpecialty[] $medicalSpecialties */
        $medicalSpecialties = $this->entityManager->getRepository(MedicalSpecialty::class)->findAll();
        $result = [];
        foreach ($medicalSpecialties as $medicalSpecialty) {
            $result[] = $medicalSpecialty->toFrontEndArray();
        }
        $cacheItem = $this->cache->getItem(md5(self::CACHE_KEY));
        $cacheItem->set($result);
        $cacheItem->expiresAfter(self::CACHE_EXPIRATION_TIME);
        $this->cache->save($cacheItem);
        $this->result = $result;
    }
}
