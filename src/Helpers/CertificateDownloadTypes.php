<?php

declare(strict_types=1);

namespace Xolphin\Helpers;

class CertificateDownloadTypes
{
    /**
     * @var string CRT
     */
    const CRT = "CRT";

    /**
     * @var string CSR
     */
    const CSR = "CSR";

    /**
     * @var string ZIP
     */
    const ZIP = "ZIP";

    /**
     * @var string PKCS7
     */
    const PKCS7 = "PKCS7";

    /**
     * @var string CA
     */
    const CA = "CA";

    /**
     * @var string CA_BUNDLE
     */
    const CA_BUNDLE = "CA_BUNDLE";
}