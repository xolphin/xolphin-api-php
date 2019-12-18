<?php namespace Tests\Endpoint;

use DateTime;
use Tests\TestCase;
use Xolphin\Helpers\DCVTypes;
use Xolphin\Helpers\RequestLanguage;
use Xolphin\Responses\Base;
use Xolphin\Responses\Note;
use Xolphin\Responses\Product;
use Xolphin\Responses\Request;

class RequestTest extends TestCase
{
    /**
     * @description "Get all requests"
     */
    public function testGetAllRequestsSuccess()
    {
        $requests = $this->_client->requests->all();
        $this->assertIsArray($requests);

        if (count($requests) > 0) {
            $this->assertInstanceOf(Request::class, reset($requests));
            $this->assertInstanceOf(Request::class, end($requests));
        }
    }


    /**
     * @description "Get request success"
     */
    public function testGetRequestSuccess()
    {
        $requestId = 960000024;
        $request = $this->_client->requests->get($requestId);
        $this->assertEquals(false, $request->isError());
        $this->assertEquals($requestId, $request->id);
        $this->assertEquals('test24.ssl-test.nl', $request->domainName);
        $this->assertEquals(1, $request->years);
        $this->assertEquals('Xolphin B.V.', $request->company);
        $this->assertInstanceOf(DateTime::class, $request->dateOrdered);
        $this->assertIsArray($request->validations);
        $this->assertEquals('Xolphin', $request->approverFirstName);
        $this->assertEquals('API Test', $request->approverLastName);
        $this->assertEquals('admin@ssl-test.nl', $request->approverEmail);
        $this->assertNull($request->kvk);
    }


    /**
     * @description "Retry DCV"
     */
    public function testRetryDCVSuccess()
    {
        $request = $this->_client->requests->retryDCV(960000024, 'test24-san-1.ssl-test.nl', DCVTypes::EMAIL_VALIDATION,
            'test@ssl-test.nl');

        $this->assertFalse($request->isError());
        $this->assertEquals('The DCV will be retried shortly.', $request->getMessage());
        $this->assertNull($request->getErrorData());
    }

    /**
     * @description "Schedule validation call"
     */
    public function testScheduleValidationCallSuccess()
    {
        $date = new DateTime('2020-01-21');
        $date->setTime(14, 00, 00);

        $request = $this->_client->requests->scheduleValidationCall(960000024, $date);

        $this->assertEquals(false, $request->isError());
        $this->assertNull($request->getErrorData());
        $this->assertEquals('The phone call has successfully been scheduled.', $request->getMessage());
        $this->assertInstanceOf(Base::class, $request);
        $this->assertNull($request->page);
        $this->assertNull($request->pages);
        $this->assertNull($request->total);
        $this->assertNull($request->limit);
    }

    /**
     * @description "Create a new request"
     */
    public function testCreateRequestSuccess()
    {
        $csr = "-----BEGIN CERTIFICATE REQUEST-----
MIICzTCCAbUCAQAwgYcxCzAJBgNVBAYTAk5MMRYwFAYDVQQIEw1Ob29yZC1Ib2xs
YW5kMRYwFAYDVQQHEw1IZWVyaHVnb3dhYXJkMSEwHwYDVQQKExhYb2xwaGluIFNT
TCBDZXJ0aWZpY2F0ZW4xDDAKBgNVBAsTA0lDVDEXMBUGA1UEAxMOaXZvLnhvbHBo
aW4ubmwwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDJ2K0PiWYgN/rR
pe9BX77OSzaG45Vjvf5c+GK+Sbsf5JLCAm8KMypvNaVdcDznBiK0JWaCk7v95tbg
54RYsL4qPyowsryZjqe0Dghh9mWNQO8cgKNpBxO5mvEuaUtGtZR6JPZwHdcvlAob
Ap2AOSGmg5NKQnlw9FCv5HN24g6Lkk9SONUwwZ7aqKrAtuXBSqSeyoHr2Fx5hCDp
7i3aY/2P/13v8AjbHERrsipj8YsIcUh7h1H3f36reJIE05dCsU8HKwMUQ1pNESo3
q4KLqc+NokIipnOtN6EG5lYYJZ9zZ7NHrxv5OYYVjagWQQXANCOHF/bXYX4ZUqH3
t3+qHwKtAgMBAAGgADANBgkqhkiG9w0BAQUFAAOCAQEAn+Tvzr0439NgdJGbPHHv
VxCmx1YYyw9v/b0pYPnqI4Gz+Y5HxQzEbeAygWS82WdO3cqJo2pK140P8qgCkpQ/
Gd5H+R2xNDMOHagqhFsA5sbk3XJhBAS0U9IHKq9Iy1KP+SwHxzapHeQN7+wzrmaL
9CsyQSh1YeMJrYTB7JjlMNbxeaUKwxmN5YWV5xKGmpLikaotSwT1oNRlIUV7iHY9
YKe+9OypwvHHlRT+wya3ERio1UZ8AuLzE0dKXlZer4WdsurNEotXbyztwB1/Xkkl
3cP7QkMUZ+Lb0k64tHYnNL7qQMUVryhK7DgYg+3F8LCPkJn/DajfSh5/ZODJ5QGd
xg==
-----END CERTIFICATE REQUEST-----";
        $approverEmail = 'test@xolphin.nl';
        $param = $this->_client->requests->create(18, 1, $csr,  DCVTypes::EMAIL_VALIDATION);
        $param->setApproverEmail($approverEmail);
        $param->setLanguage(RequestLanguage::ENGLISH);

        $request = $this->_client->requests->send($param);

        $this->assertEquals(false, $request->isError());
        $this->assertEquals(960000000, $request->id);
        $this->assertEquals('test1.ssl-test.nl', $request->domainName);
        $this->assertEquals([], $request->subjectAlternativeNames);
        $this->assertEquals(1, $request->years);
        $this->assertEquals('Xolphin B.V.', $request->company);
        $this->assertInstanceOf(DateTime::class, $request->dateOrdered);
        $this->assertEquals('Heerhugowaard', $request->city);
        $this->assertEquals('NL', $request->country);
        $this->assertEquals('admin@ssl-test.nl', $request->approverEmail);
        $this->assertInstanceOf(Product::class, $request->product);
    }

    /**
     * @description "Get all notes for a request ID"
     */
    public function testGetAllNotes()
    {

        $requestId = 960000000;

        // we have at least one note
        $this->_client->requests->sendNote($requestId, 'Test note');
        $notes = $this->_client->requests->getNotes($requestId);

        $this->assertIsArray($notes);
        $this->assertEquals(true, count($notes) > 0);
        $this->assertInstanceOf(Note::class, $notes[0]);

    }

    /**
     * @description "Create new note for a request ID"
     */
    public function testCreateNote()
    {

        $rand = rand(1, 10000);

        $requestId = 960000024;
        $result = $this->_client->requests->sendNote($requestId, 'Test note ' . $rand);
        $notes = $this->_client->requests->getNotes($requestId);
        $last_note = end($notes);

        $this->assertEquals(false, $result->isError());
        $this->assertEquals('The message is successfully sent.', $result->getMessage());
        // message has unique name
        $this->assertEquals('Test note ' . $rand, $last_note->messageBody);
        // message was added in last 10 seconds
        $this->assertEqualsWithDelta($last_note->createdAt->diff(new DateTime())->format("%s"), 0, 10);

    }

    /**
     * @description "Send Sectigo SA email (can be tested only on production API)"
     */
    public function testSendSectigoSAEmail()
    {

        $requestId = 960000024;
        $to = 'email@example.com';

        $result = $this->_client->requests->sendSectigoSAEmail($requestId, $to);

        $this->assertEquals(false, $result->isError());
        $this->assertEquals('The Subscriber Agreement will be sent to the given e-mail address.',
            $result->getMessage());
    }

    public function testValidateEERequest()
    {
        $csr = '-----BEGIN CERTIFICATE REQUEST-----
MIICzTCCAbUCAQAwgYcxCzAJBgNVBAYTAk5MMRYwFAYDVQQIEw1Ob29yZC1Ib2xs
YW5kMRYwFAYDVQQHEw1IZWVyaHVnb3dhYXJkMSEwHwYDVQQKExhYb2xwaGluIFNT
TCBDZXJ0aWZpY2F0ZW4xDDAKBgNVBAsTA0lDVDEXMBUGA1UEAxMOaXZvLnhvbHBo
aW4ubmwwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDJ2K0PiWYgN/rR
pe9BX77OSzaG45Vjvf5c+GK+Sbsf5JLCAm8KMypvNaVdcDznBiK0JWaCk7v95tbg
54RYsL4qPyowsryZjqe0Dghh9mWNQO8cgKNpBxO5mvEuaUtGtZR6JPZwHdcvlAob
Ap2AOSGmg5NKQnlw9FCv5HN24g6Lkk9SONUwwZ7aqKrAtuXBSqSeyoHr2Fx5hCDp
7i3aY/2P/13v8AjbHERrsipj8YsIcUh7h1H3f36reJIE05dCsU8HKwMUQ1pNESo3
q4KLqc+NokIipnOtN6EG5lYYJZ9zZ7NHrxv5OYYVjagWQQXANCOHF/bXYX4ZUqH3
t3+qHwKtAgMBAAGgADANBgkqhkiG9w0BAQUFAAOCAQEAn+Tvzr0439NgdJGbPHHv
VxCmx1YYyw9v/b0pYPnqI4Gz+Y5HxQzEbeAygWS82WdO3cqJo2pK140P8qgCkpQ/
Gd5H+R2xNDMOHagqhFsA5sbk3XJhBAS0U9IHKq9Iy1KP+SwHxzapHeQN7+wzrmaL
9CsyQSh1YeMJrYTB7JjlMNbxeaUKwxmN5YWV5xKGmpLikaotSwT1oNRlIUV7iHY9
YKe+9OypwvHHlRT+wya3ERio1UZ8AuLzE0dKXlZer4WdsurNEotXbyztwB1/Xkkl
3cP7QkMUZ+Lb0k64tHYnNL7qQMUVryhK7DgYg+3F8LCPkJn/DajfSh5/ZODJ5QGd
xg==
-----END CERTIFICATE REQUEST-----';

        $request = $this->_client->requests->createEE();
        $request->setCsr($csr);
        $request->setApproverEmail('nikita.vorotnyak@gmail.com');
        $request->setApproverFirstName('Nikita');
        $request->setApproverLastName('Vorotnyak');
        $request->setApproverPhone(123445677);
        $request->setDcvType('FILE');
        $request->setValidate(true);

        $response = $this->_client->requests->sendEE($request);
        $this->assertEquals('No validation errors found.', $response->getMessage());
        $this->assertEquals('test certificate', $response->crt);
    }

}
