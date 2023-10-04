export const countDecimalDigits = n => {
    if (Number.isInteger(n)) return 0;
    const arr = n.toString().split('.');
    return arr[1].length;
};

export const randomInt = (min = 1, max = 999999) => {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
};

export const randomFloat = (min = 0.0, max = 1.0, precision = null) => {
    const value = (Math.random() * (max - min)) + min;
    if (precision !== null) return parseFloat(value.toFixed(precision));
    return value;
};

export const randomBoolean = () => randomInt(0, 1) === 0;
