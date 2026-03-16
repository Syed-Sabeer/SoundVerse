<?php

namespace App\Services;

/**
 * ISRC (International Standard Recording Code) Service
 * 
 * ISRC Format: CC-XXX-YY-NNNNN
 * - CC = Country code (2 letters, e.g., "US", "GB")
 * - XXX = Registrant code (3 alphanumeric)
 * - YY = Year (2 digits)
 * - NNNNN = Designation code (5 digits)
 * 
 * Example: USRC17607839
 */
class ISRCService
{
    /**
     * Default country code (can be configured)
     */
    private $countryCode = 'US';

    /**
     * Default registrant code (can be configured per platform)
     */
    private $registrantCode = 'SGM'; // SingWithMe

    /**
     * Generate a unique ISRC code for a track
     * 
     * @param int $artistId Optional artist ID for uniqueness
     * @return string ISRC code (12 characters)
     */
    public function generateISRC($artistId = null)
    {
        $year = date('y'); // Last 2 digits of current year
        
        // Generate designation code (5 digits)
        // Use timestamp + random for uniqueness
        $timestamp = time() % 100000; // Last 5 digits of timestamp
        $random = rand(0, 9999);
        $designationCode = str_pad(($timestamp + $random) % 100000, 5, '0', STR_PAD_LEFT);
        
        // If artist ID provided, incorporate it for additional uniqueness
        if ($artistId) {
            $artistPart = ($artistId % 100); // Last 2 digits of artist ID
            $designationCode = str_pad((($timestamp + $random + $artistPart) % 100000), 5, '0', STR_PAD_LEFT);
        }
        
        // Combine: CC + XXX + YY + NNNNN (12 characters total)
        $isrc = strtoupper($this->countryCode . $this->registrantCode . $year . $designationCode);
        
        return $isrc;
    }

    /**
     * Validate ISRC code format
     * 
     * @param string $isrc
     * @return bool
     */
    public function validateISRC($isrc)
    {
        // Remove hyphens if present (ISRC can be formatted with or without hyphens)
        $isrc = str_replace('-', '', strtoupper(trim($isrc)));
        
        // Should be exactly 12 alphanumeric characters
        if (strlen($isrc) !== 12) {
            return false;
        }
        
        // Should match pattern: 2 letters (country) + 3 alphanumeric (registrant) + 2 digits (year) + 5 digits (designation)
        return preg_match('/^[A-Z]{2}[A-Z0-9]{3}[0-9]{2}[0-9]{5}$/', $isrc);
    }

    /**
     * Format ISRC code with hyphens
     * 
     * @param string $isrc
     * @return string Formatted as CC-XXX-YY-NNNNN
     */
    public function formatISRC($isrc)
    {
        $isrc = str_replace('-', '', strtoupper(trim($isrc)));
        
        if (strlen($isrc) !== 12) {
            return $isrc; // Return as-is if invalid format
        }
        
        return substr($isrc, 0, 2) . '-' . 
               substr($isrc, 2, 3) . '-' . 
               substr($isrc, 5, 2) . '-' . 
               substr($isrc, 7, 5);
    }

    /**
     * Set country code
     * 
     * @param string $code 2-letter country code
     */
    public function setCountryCode($code)
    {
        $this->countryCode = strtoupper(substr($code, 0, 2));
    }

    /**
     * Set registrant code
     * 
     * @param string $code 3-character registrant code
     */
    public function setRegistrantCode($code)
    {
        $this->registrantCode = strtoupper(substr($code, 0, 3));
    }
}
