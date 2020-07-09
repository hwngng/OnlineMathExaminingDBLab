$('.fa-flag').click(function () {
    $(this).toggleClass('flagged');
})


class Timer {
    constructor(durationInput) {
        this.durationInput = durationInput;
        this.tick = this.tick.bind(this);
    }

    saveTotalDuration() {
        this.totalDuration = this.durationInput.value;
    }

    getTotalDuration() {
        return this.totalDuration;
    }

    start() {
        if (!parseFloat(durationInput.value)) {
            return;
        }

        // if timer is not paused only then save total duration
        if (!this.pausedTime) {
            // save total duration, used for timer animation
            this.saveTotalDuration();
        }


        this.tick();
        this.intervalId = setInterval(this.tick, 50);
    }

    tick() {
        durationInput.value = (durationInput.value - 0.05).toFixed(2);

        Animation.onTick();

        if (durationInput.value == 0) {
            clearInterval(this.intervalId);

            durationInput.value = '';

            Animation.onComplete();
        }
    }

    stop() {
        clearInterval(this.intervalId);

        durationInput.value = '';

        Animation.stopAnimation();
    }
}

// setting stroke-dasharray attribute on the circle element
const circle = document.querySelector('circle');
const circleRadius = circle.getAttribute('r');
const circlePerimeter = 2 * circleRadius * Math.PI;

circle.setAttribute('stroke-dasharray', circlePerimeter);

const durationInput = document.getElementById('duration');

const timer = new Timer(durationInput);


let currentOffset = 0;

class Animation {
    static onStart() {
        durationInput.setAttribute('readonly', true);
    }

    static onTick() {
        currentOffset = (circlePerimeter * durationInput.value) / timer.getTotalDuration() - circlePerimeter;
        circle.setAttribute('stroke-dashoffset', currentOffset);
    }

    static stopAnimation() {
        // show complete circle
        circle.setAttribute('stroke-dashoffset', 0);
        durationInput.removeAttribute('readonly');
    }

    static onComplete() {
        Animation.stopAnimation();
    }
}


