<?php

namespace Tests\Responses;

use Tests\TestCase;
use Xolphin\Responses\Note;

class NoteTest extends TestCase
{
    public function testConstructWithStaffAndContact()
    {
        $noteData = [
            'message' => 'Test message',
            'staff' => 'Staff name',
            'contact' => 'Contact name',
        ];

        $note = new Note((object) $noteData);

        $this->assertEquals('Test message', $note->messageBody);
        $this->assertEquals('Staff name', $note->staff);
        $this->assertEquals('Contact name', $note->contact);
    }


    public function testConstructWithoutStaffAndContact()
    {
        $noteData = [
            'message' => 'Test message',
        ];

        $note = new Note((object) $noteData);

        $this->assertEquals('Test message', $note->messageBody);
        $this->assertNull($note->staff);
        $this->assertNull($note->contact);
    }
}
