const data = () => ({
    today: require('dayjs')().startOf('day'),
});

const methods = {
    formControlClass(field) {
        return {
            'is-valid': Object.keys(this.errors).length && this.errors[field] === undefined,
            'is-invalid': this.errors[field],
        };
    },
    minutesToString: (totalMinutes) => Math.floor(totalMinutes / 60) + ':' + String(totalMinutes % 60).padStart(2, '0'),
};

export {
    data,
    methods,
};
