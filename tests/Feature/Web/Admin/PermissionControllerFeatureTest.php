<?php

namespace Tests\Feature\Web\Admin;

use App\Http\Controllers\Web\Admin\PermissionController;
use App\Interfaces\Gateways\Web\Admin\PermissionRepositoryInterface;
use App\Interfaces\Presenters\Web\Admin\PermissionPresenter;
use App\UseCases\Web\Admin\PermissionUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class PermissionControllerFeatureTest extends TestCase
{
    protected $permissionRepository;
    protected $permissionPresenter;
    protected $permissionUseCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->permissionRepository = Mockery::mock(PermissionRepositoryInterface::class);
        $this->permissionPresenter = Mockery::mock(PermissionPresenter::class);
        $this->permissionUseCase = Mockery::mock(PermissionUseCase::class);

        $this->app->instance(PermissionRepositoryInterface::class, $this->permissionRepository);
        $this->app->instance(PermissionPresenter::class, $this->permissionPresenter);
        $this->app->instance(PermissionUseCase::class, $this->permissionUseCase);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    public function testIndex()
    {
        // Mock data
        $allPermissions = [
            [
                'id' => 1,
                'name' => 'admin',
                'name_i18n' => json_encode(['ar' => 'مسؤول', 'en' => 'admin']),
                'guard_name' => 'admin'
            ]
        ];

        // Mock behavior
        $this->permissionUseCase->shouldReceive('allPermissions')->andReturn($allPermissions);
        $this->permissionPresenter->shouldReceive('presentAllPermissions')->with($allPermissions)->andReturn('Expected output'); // Define your expected return value here

        // Make request to controller
        $response = $this->get(route('admin.permissions.index'));

        // Assert
        $response->assertStatus(200); // Assuming 200 is the correct status code
        // Add more assertions as needed
    }
}
