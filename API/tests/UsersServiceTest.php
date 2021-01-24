<?php

use App\Services\UsersService;

use PHPUnit\Framework\TestCase as TestCase;

class UsersServiceTest extends TestCase {

    private UsersService $_usersService;

    protected function setUp() : void {
        $this->_usersService = new UsersService();
    }

    public function testExtractCounterPartInSponsorshipRelationship() : void {
        // arrange: we setup sponsorship data and corresponding users id's in variables
        $sponsorshipData = [ "id => 1", "sponsorId" => 1, "sponsoredId" => 2 ];
        $sponsorId        = 1;
        $sponsoredId      = 2;
        // act: we extract counterpart in sponsorship id's for both sponsor and sponsored
        $sponsorCounterpart = $this->_usersService->extractCounterpartInSponsorshipRelationship( 
            $sponsorshipData, $sponsorId
        );
        $sponsoredCounterpart = $this->_usersService->extractCounterpartInSponsorshipRelationship( 
            $sponsorshipData, $sponsoredId
        );
        // assert: we verify that counterparts are the expected ones
        $this->assertEquals( 2, $sponsorCounterpart );
        $this->assertEquals( 1, $sponsoredCounterpart );
    }

}