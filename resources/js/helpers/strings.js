export const randomString = (length = 8, capitals = false, numbers = false) => {
    let chars = 'abcdefghijklmnopqrstuvwxyz';
    if (capitals) chars += chars.toUpperCase();
    if (numbers) chars += '1234567890';

    let value = '';

    while (value.length < length) {
        value += chars[Math.floor(Math.random() * chars.length)];
    }

    return value;
};
