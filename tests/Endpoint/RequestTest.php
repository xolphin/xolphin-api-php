<?php namespace Tests\Endpoint;

use Tests\TestCase;

class RequestTest extends TestCase
{
    /**
     * @description "Get all requests"
     */
    public function testGetAllRequestsAll()
    {
        $requests = $this->_client->request()->all();
        $this->assertInternalType('array', $requests);

        if(count($requests) > 0)
        {
            $this->assertInstanceOf('\Xolphin\Responses\Request', reset($requests));
            $this->assertInstanceOf('\Xolphin\Responses\Request', end($requests));
        }
    }


    /**
     * @description "Get request success"
     */
    public function testGetRequestSuccess()
    {
        $requestId = 960000022;
        $request = $this->_client->request()->get($requestId);

        $this->assertEquals($requestId, $request->id);
        $this->assertEquals('test22.ssl-test.nl', $request->domainName);
        $this->assertEquals(1, $request->years);
        $this->assertEquals('Xolphin B.V.', $request->company);
        $this->assertInstanceOf('\DateTime', $request->dateOrdered);
        $this->assertInternalType('array', $request->validations);
        $this->assertEquals('Xolphin', $request->approverFirstName);
        $this->assertEquals('API Test', $request->approverLastName);
        $this->assertEquals('webmaster@ssl-test.nl', $request->approverEmail);
        $this->assertNull($request->kvk);
    }


    /**
     * @description "Retry DCV"
     */
    public function testRetryDCVSuccess()
    {
        $request = $this->_client->request()->retryDCV(960000024, 'test24-san-1.ssl-test.nl', 'EMAIL','test@ssl-test.nl');

        $this->assertEquals('The DCV will be retried shortly.', $request->getErrorMessage());
        $this->assertNull($request->getErrorData());
    }
    
    /**
     * @description "Schedule validation call"
     */
    public function testScheduleValidationCallSuccess()
    {
        $date = new \DateTime('2016-11-21');
        $date->setTime(14, 00, 00);

        $request = $this->_client->request()->scheduleValidationCall(960000024, $date);

        $this->assertNull($request->getErrorData());
        $this->assertEquals('The phone call has successfully been scheduled.', $request->getErrorMessage());
        $this->assertInstanceOf('\Xolphin\Responses\Base', $request);
        $this->assertNull($request->page);
        $this->assertNull($request->pages);
        $this->assertNull($request->total);
        $this->assertNull($request->limit);
    }

    /**
     * @description "Create a new request"
     */
    public function  testCreateRequestSuccess()
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
        $approverEmail = 'oleh@xolphin.nl';
        $param = $this->_client->request()->create(18, 1, $csr, 'EMAIL');
        $param->setApproverEmail($approverEmail);
        $param->setLanguage('en');

        $request = $this->_client->request()->send($param);

        $this->assertEquals(960000000, $request->id);
        $this->assertEquals('test1.ssl-test.nl', $request->domainName);
        $this->assertEquals([], $request->subjectAlternativeNames);
        $this->assertEquals(1, $request->years);
        $this->assertEquals('Xolphin B.V.', $request->company);
        $this->assertInstanceOf('\DateTime', $request->dateOrdered);
        $this->assertEquals('Heerhugowaard', $request->city);
        $this->assertEquals('NL', $request->country);
        $this->assertEquals('admin@ssl-test.nl', $request->approverEmail);
        $this->assertInstanceOf('\Xolphin\Responses\Product', $request->product);
    }

    /**
     * @description "Get all notes for a request ID"
     */
    public function testGetAllNotes(){

        $requestId = 960000000;

        // we have at least one note
        $this->_client->request()->sendNote($requestId,'Test note');
        $notes = $this->_client->request()->getNotes($requestId);

        $this->assertInternalType('array',$notes);
        $this->assertEquals(true, count($notes) > 0);
        $this->assertInstanceOf('\Xolphin\Responses\Note', $notes[0]);

    }

    /**
     * @description "Create new note for a request ID"
     */
    public function testCreateNote(){

        $rand = rand(1,10000);

        $requestId = 960000000;
        $result = $this->_client->request()->sendNote($requestId,'Test note '.$rand);
        $last_note = end($this->_client->request()->getNotes($requestId));

        $this->assertEquals('The message is successfully sent.', $result->getErrorMessage());
        // message has unique name
        $this->assertEquals('Test note '.$rand, $last_note->messageBody);
        // message was added in last 10 seconds
        $this->assertEquals($last_note->createdAt->diff(new \DateTime())->format("%s"), 0, '', 10);

    }

    /**
     * @description "Send Comodo SA email (can be tested only on production API)"
     */
    public function testSendComodoSAEmail(){

        $requestId = 962052406;
        $to = 'email@example.com';

        $result = $this->_client->request()->sendComodoSAEmail($requestId, $to);

        $this->assertEquals('The Subscriber Agreement will be sent to the given e-mail address.',$result->getErrorMessage());
    }

}
