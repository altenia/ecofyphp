<?php

use Altenia\Ecofy\CoreService\AccessControl;

class AccessControlTest extends PHPUnit_Framework_TestCase {

	/**
	 * Test updating an empty policy
	 */
	public function testUpdatePolicy()
	{
		$accessControl = new AccessControl;
		$accessControl->updatePolicy('doc:fal1', 7);

		$accessControlExp = new AccessControl;
		$accessControlExp->setPolicyFromJson('
		{
        	"doc:fal1": {
        		"@permissions": 7
        	}
        }');

        $this->assertEquals($accessControl->policy, $accessControlExp->policy);

		$accessControl->updatePolicy('doc:fal1', 7);
        $this->assertEquals($accessControl->policy, $accessControlExp->policy);
	}

	/**
	 * Test updating adding a new root entry
	 */
	public function testUpdatePolicyAddEntry()
	{
		$accessControl = $this->createAccessControlModel();
		$accessControl->updatePolicy('doc:fal2', 9);

		$accessControlExp = new AccessControl;
		$accessControlExp->setPolicyFromJson('
		{
        	"doc:fal1": {
	            "@permissions": 7,
	            "field:title": { "@permissions": 15 },
	            "field:access_code": { "@permissions": 0 }
        	},
        	"doc:fal2": {
        		"@permissions": 9
        	}
        }');

        $this->assertEquals($accessControl->policy, $accessControlExp->policy);
	}

	/**
	 * Test updating adding a new sub entry
	 */
	public function testUpdatePolicyAddSubEntry()
	{
		$accessControl = $this->createAccessControlModel();
		$accessControl->updatePolicy('doc:fal1/field:another_field', 2);

		$accessControlExp = new AccessControl;
		$accessControlExp->setPolicyFromJson('
		{
        	"doc:fal1": {
	            "@permissions": 7,
	            "field:title": { "@permissions": 15 },
	            "field:access_code": { "@permissions": 0 },
	            "field:another_field": { "@permissions": 2 }
        	}
        }');

        $this->assertEquals($accessControl->policy, $accessControlExp->policy);
	}

	/**
	 * Test updating adding a new sub-sub entry
	 */
	public function testUpdatePolicyAddSubSubEntry()
	{
		$accessControl = $this->createAccessControlModel();
		$accessControl->updatePolicy('doc:fal1/field:another_field/sub', 3);

		$accessControlExp = new AccessControl;
		$accessControlExp->setPolicyFromJson('
		{
        	"doc:fal1": {
	            "@permissions": 7,
	            "field:title": { "@permissions": 15 },
	            "field:access_code": { "@permissions": 0 },
	            "field:another_field": { 
	            	"sub": { "@permissions": 3}
	            }
        	}
        }');

        $this->assertEquals($accessControl->policy, $accessControlExp->policy);
	}

	/**
	 * Test getting permission of undefined resource (null)
	 */
	public function testGetPermissionsOfUndefinedResource()
	{
		$accessControl = $this->createAccessControlModel();
		$this->assertEquals($accessControl->getPermissions(null), 3);
		$this->assertEquals($accessControl->getPermissions(''), 3);
		$this->assertEquals($accessControl->getPermissions(' '), 3);
	}

	/**
	 * Test for the case where checks for null or empty
	 */
	public function testPermissibleUndefinedResource()
	{
		$accessControl = $this->createAccessControlModel();

		$this->assertTrue($accessControl->check(1, null));
		$this->assertTrue($accessControl->check(1, ''));
		$this->assertTrue($accessControl->check(2, null));
		$this->assertTrue($accessControl->check(2, ' '));
	}

	/**
	 * Test getting permission of unspecified resource
	 */
	public function testGetPermissionsOfUnspecifiedResource()
	{
		$accessControl = $this->createAccessControlModel();
		$this->assertEquals($accessControl->getPermissions('undefined_resource'), 3);
		$this->assertEquals($accessControl->getPermissions('undefined/resource'), 3);
	}
	/**
	 * Test for the case where checks for unspecifed resource and results true
	 */
	public function testPermissibleUnspecifiedResource()
	{
		$accessControl = $this->createAccessControlModel();

		$this->assertTrue($accessControl->check(2, 'undefined_resource'));
		$this->assertTrue($accessControl->check(2, 'undefined/resource'));
	}


	/**
	 * Test for the case where checks for undefined resource and results false
	 *
	 * @return void
	 */
	public function testNonPermissibleUndefinedResource()
	{
		$accessControl = $this->createAccessControlModel();

		// Two  permissibles
		$this->assertFalse($accessControl->check(4, null));
		$this->assertFalse($accessControl->check(8, ''));
		$this->assertFalse($accessControl->check(4, null));
		$this->assertFalse($accessControl->check(8, ''));
		$this->assertFalse($accessControl->check(16, 'undefined_resource'));
		$this->assertFalse($accessControl->check(32, 'undefined/resource'));
	}

	public function testGetPermissionsOfDefinedResource()
	{
		$accessControl = $this->createAccessControlModel();
		$this->assertEquals($accessControl->getPermissions('doc:fal1'), 7);
		$this->assertEquals($accessControl->getPermissions('doc:fal1/field:title'), 15);
		$this->assertEquals($accessControl->getPermissions('doc:fal1/field:access_code'), 0);
	}

	/**
	 * Test for the case where checks for undefined resource and results true
	 *
	 * @return void
	 */
	public function testPermissibleDefinedResource()
	{
		$accessControl = $this->createAccessControlModel();

		$this->assertTrue($accessControl->check(1, 'doc:fal1'));
		$this->assertTrue($accessControl->check(4, 'doc:fal1'));
		$this->assertTrue($accessControl->check(2, 'doc:fal1/field:title'));
		$this->assertTrue($accessControl->check(4, 'doc:fal1/field:title'));
		$this->assertTrue($accessControl->check(8, 'doc:fal1/field:title'));
	}

	/**
	 * Test for the case where checks for undefined resource and results false
	 *
	 * @return void
	 */
	public function testNonPermissibleDefinedResource()
	{
		$accessControl = $this->createAccessControlModel();

		$this->assertFalse($accessControl->check(8, 'doc:fal1'));
		$this->assertFalse($accessControl->check(16, 'doc:fal1'));
		$this->assertFalse($accessControl->check(32, 'doc:fal1/field:title'));
		$this->assertFalse($accessControl->check(64, 'doc:fal1/field:title'));
		$this->assertFalse($accessControl->check(128, 'doc:fal1/field:title'));
		$this->assertFalse($accessControl->check(1, 'doc:fal1/field:access_code'));
		$this->assertFalse($accessControl->check(2, 'doc:fal1/field:access_code'));
	}

	public function createAccessControlModel()
	{
		$accessControl = new AccessControl;
		$accessControl->permissions = 3;
		$accessControl->setPolicyFromJson('
		{
        	"doc:fal1": {
	            "@permissions": 7,
	            "field:title": { "@permissions": 15 },
	            "field:access_code": { "@permissions": 0 }
        	}
        }');

		return $accessControl;
	}

}