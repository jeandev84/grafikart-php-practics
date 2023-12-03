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

use Grafikart\Event\Emitter;
use Kahlan\Plugin\Double;

describe(Emitter::class, function () {

    beforeEach(function () {
        $reflection = new ReflectionClass(Emitter::class);
        $instance   = $reflection->getProperty('instance');
        #$instance->setAccessible(true);
        $instance->setValue(null, null);
        #$instance->setAccessible(false);
    });


    given('emmitter', function () {
        return Emitter::getInstance();
    });


    it('should be a singleton', function () {
        $emitter = Emitter::getInstance();
        expect($emitter)->toBeAnInstanceOf(Emitter::class);
        expect($emitter)->toBe(Emitter::getInstance());
    });

    describe('::on', function () {
        it('should trigger the listened event', function () {
            $this->emitter  = Emitter::getInstance();
            $listener = Double::instance();
            $comment  = ['name' => 'John'];

            expect($listener)->toReceive('onNewComment')->once()->with($comment);
            # expect($listener)->toReceive('onNewComment')->times(2)->with($comment);

            $this->emitter->on('Comment.created', [$listener, 'onNewComment']);
            $this->emitter->emit('Comment.created', $comment);
        });

        /*
        it('test bidon', function () {
            $this->emitter = Emitter::getInstance();
            $this->emitter->emit('demo');
        });
        */
    });
});