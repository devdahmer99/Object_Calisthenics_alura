<?php

namespace Alura\Calisthenics\Tests\Unit\Domain\Video;

use Alura\Calisthenics\Domain\Student\Student;
use Alura\Calisthenics\Domain\Video\InMemoryVideoRepository;
use Alura\Calisthenics\Domain\Video\Video;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class InMemoryVideoRepositoryTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testFindingVideosForAStudentMustFilterAgeLimit()
    {
        $repository = new InMemoryVideoRepository();

        // [21, 20, 19, 18, 17]
        for ($i = 21; $i >= 17; $i--) {
            $video = new Video();
            $video->setAgeLimit($i);
            $repository->add($video);
        }

        $student = $this->createStub(Student::class);
        $student->method('age')->willReturn(new DateTimeImmutable(19));

        $videoList = $repository->videosFor($student);

        self::assertCount(3, $videoList);
    }
}
