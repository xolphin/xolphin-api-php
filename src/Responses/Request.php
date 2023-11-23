<?php

declare(strict_types=1);

namespace Xolphin\Responses;

use DateTime;
use Exception;

class Request extends Base
{
    /** @var int|null */
    public ?int $id = null;

    /** @var string|null */
    public ?string $domainName = null;

    /** @var string[] */
    public array $subjectAlternativeNames = [];

    /** @var int|null */
    public ?int $years = null;

    /** @var string|null */
    public ?string $company = null;

    /** @var DateTime|null */
    public ?DateTime $dateOrdered = null;

    /** @var RequestValidation[] */
    public array $validations = [];

    /** @var string|null */
    public ?string $department = null;

    /** @var string|null */
    public ?string $address = null;

    /** @var string|null */
    public ?string $zipcode = null;

    /** @var string|null */
    public ?string $city = null;

    /** @var string|null */
    public ?string $province = null;

    /** @var string|null */
    public ?string $country = null;

    /** @var string|null */
    public ?string $reference = null;

    /** @var string|null */
    public ?string $approverFirstName = null;

    /** @var string|null */
    public ?string $approverLastName = null;

    /** @var string|null */
    public ?string $approverEmail = null;

    /** @var string|null */
    public ?string $approverPhone = null;

    /** @var string|null */
    public ?string $approverRepresentativePosition = null;

    /** @var string|null */
    public ?string $approverRepresentativeFirstName = null;

    /** @var string|null */
    public ?string $approverRepresentativeLastName = null;

    /** @var string|null */
    public ?string $approverRepresentativeEmail = null;

    /** @var string|null */
    public ?string $approverRepresentativePhone = null;

    /** @var string|null */
    public ?string $kvk = null;

    /** @var Product|null */
    public ?Product $product = null;

    /** @var bool */
    public bool $requiresAction = false;

    /** @var bool */
    public bool $brandValidation = false;

    /** @var Note[] */
    public array $notes = [];

    /**
     * Request constructor.
     * @param object $data
     * @throws Exception
     */
    public function __construct($data)
    {
        parent::__construct($data);

        if (!$this->isError()) {
            if (isset($data->id)) {
                $this->id = (int) $data->id;
            }
            if (isset($data->domainName)) {
                $this->domainName = $data->domainName;
            }
            if (isset($data->subjectAlternativeNames)) {
                $this->subjectAlternativeNames = $data->subjectAlternativeNames;
            }
            if (isset($data->years)) {
                $this->years = (int) $data->years;
            }
            if (isset($data->company)) {
                $this->company = $data->company;
            }
            if (isset($data->dateOrdered)) {
                $this->dateOrdered = DateTime::createFromFormat(DateTime::ATOM, $data->dateOrdered);
            }
            if (isset($data->department)) {
                $this->department = $data->department;
            }
            if (isset($data->address)) {
                $this->address = $data->address;
            }
            if (isset($data->zipcode)) {
                $this->zipcode = $data->zipcode;
            }
            if (isset($data->city)) {
                $this->city = $data->city;
            }
            if (isset($data->province)) {
                $this->province = $data->province;
            }
            if (isset($data->country)) {
                $this->country = $data->country;
            }
            if (isset($data->reference)) {
                $this->reference = $data->reference;
            }
            if (isset($data->approverFirstName)) {
                $this->approverFirstName = $data->approverFirstName;
            }
            if (isset($data->approverLastName)) {
                $this->approverLastName = $data->approverLastName;
            }
            if (isset($data->approverEmail)) {
                $this->approverEmail = $data->approverEmail;
            }
            if (isset($data->approverPhone)) {
                $this->approverPhone = $data->approverPhone;
            }
            if (isset($data->approverRepresentativePosition)) {
                $this->approverRepresentativePosition = $data->approverRepresentativePosition;
            }
            if (isset($data->approverRepresentativeFirstName)) {
                $this->approverRepresentativeFirstName = $data->approverRepresentativeFirstName;
            }
            if (isset($data->approverRepresentativeLastName)) {
                $this->approverRepresentativeLastName = $data->approverRepresentativeLastName;
            }
            if (isset($data->approverRepresentativeEmail)) {
                $this->approverRepresentativeEmail = $data->approverRepresentativeEmail;
            }
            if (isset($data->approverRepresentativePhone)) {
                $this->approverRepresentativePhone = $data->approverRepresentativePhone;
            }
            if (isset($data->kvk)) {
                $this->kvk = $data->kvk;
            }
            if (isset($data->requiresAction)) {
                $this->requiresAction = (bool) $data->requiresAction;
            }
            if (isset($data->brandValidation)) {
                $this->brandValidation = (bool) $data->brandValidation;
            }

            if (!empty($data->validations)) {
                foreach (get_object_vars($data->validations) as $k => $v) {
                    $this->validations[$k] = new RequestValidation($data->validations->$k);
                }
            }

            if (isset($data->_embedded->product)) {
                $this->product = new Product($data->_embedded->product);
            }

            if (isset($data->_embedded->notes) && is_array($data->_embedded->notes)) {
                foreach ($data->_embedded->notes as $note) {
                    $this->notes[] = new Note($note);
                }
            }
        }
    }
}
