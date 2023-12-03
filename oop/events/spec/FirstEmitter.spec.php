<?php
// https://github.com/kahlan/kahlan
// https://kahlan.github.io/docs
// ./vendor/bin/kahlan
/*
describe(\Grafikart\Event\Emitter::class, function () {
    it('should 1=1', function () {
        expect(1)->toBe(1);
    });
});
*/

/*
use Grafikart\Event\Emitter;

describe(Emitter::class, function () {

    it('should be a singleton', function () {
        $emitter = Emitter::getInstance();
        expect($emitter)->toBeAnInstanceOf(Emitter::class);
        expect($emitter)->toBe(Emitter::getInstance());
    });

    describe('::on', function () {
        it('should trigger the listened event', function () {
            $emitter = Emitter::getInstance();
            $calls = [];
            $emitter->on('Comment.created', function () use (&$calls) {
                $calls[] = 2;
            });
            expect(count($calls))->toBe(0);
            $emitter->emit('Comment.created');
            expect(count($calls))->toBe(1);
        });
    });
});
*/