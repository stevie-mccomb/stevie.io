Number.prototype.clamp = function (min, max) {
    if (this < min) return min;
    if (this > max) return max;
    return this;
};
