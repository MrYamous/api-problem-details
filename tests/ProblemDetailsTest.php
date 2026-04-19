<?php

declare(strict_types=1);

namespace Yamous\ProblemDetailsApi\Tests;

use PHPUnit\Framework\TestCase;
use Yamous\ProblemDetailsApi\ProblemDetails;

final class ProblemDetailsTest extends TestCase
{
    public function test_it_returns_default_values(): void
    {
        $problem = new ProblemDetails();

        $this->assertSame('about:blank', $problem->getType());
        $this->assertNull($problem->getTitle());
        $this->assertNull($problem->getStatus());
        $this->assertNull($problem->getDetail());
        $this->assertNull($problem->getInstance());
    }

    public function test_it_returns_given_values(): void
    {
        $problem = new ProblemDetails(
            type: 'https://example.com/error',
            title: 'Error',
            status: 400,
            detail: 'Something went wrong',
            instance: '/test'
        );

        $this->assertSame('https://example.com/error', $problem->getType());
        $this->assertSame('Error', $problem->getTitle());
        $this->assertSame(400, $problem->getStatus());
        $this->assertSame('Something went wrong', $problem->getDetail());
        $this->assertSame('/test', $problem->getInstance());
    }

    public function test_type_defaults_to_about_blank(): void
    {
        $problem = new ProblemDetails();

        $this->assertSame('about:blank', $problem->getType());
    }

    public function test_partial_construction(): void
    {
        $problem = new ProblemDetails(
            status: 404,
            title: 'Not Found'
        );

        $this->assertSame('about:blank', $problem->getType());
        $this->assertSame('Not Found', $problem->getTitle());
        $this->assertSame(404, $problem->getStatus());
        $this->assertNull($problem->getDetail());
        $this->assertNull($problem->getInstance());
    }

    public function test_it_stores_extensions(): void
    {
        $problem = new ProblemDetails(
            extensions: [
                'foo' => 'bar',
                'count' => 123,
            ]
        );

        $this->assertSame([
            'foo' => 'bar',
            'count' => 123,
        ], $problem->getExtensions());
    }

    public function test_it_rejects_reserved_extension_keys(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new ProblemDetails(
            extensions: [
                'status' => 418,
            ]
        );
    }

    public function test_it_serializes_problem(): void
    {
        $problem = new ProblemDetails(
            type: 'about:blank',
            title: 'Error',
            status: 418,
            detail: 'Something went wrong',
            instance: '/foo'
        );

        $this->assertSame([
            'type' => 'about:blank',
            'title' => 'Error',
            'status' => 418,
            'detail' => 'Something went wrong',
            'instance' => '/foo',
        ], $problem->jsonSerialize());
    }

    public function test_it_accepts_valid_status(): void
    {
        $problem = new ProblemDetails(status: 200);

        $this->assertSame(200, $problem->getStatus());
    }

    public function test_it_rejects_invalid_status(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new ProblemDetails(status: 999);
    }
}