const listeners = [];

export const on = (event, callback) => listeners.push({ event, callback });

export const off = (event, callback = null) => {
    for (let i = listeners.length - 1; i >= 0; --i) {
        const listener = listeners[i];
        if (listener.event !== event) continue;
        if (callback && listener.callback !== callback) continue;
        listeners.splice(i, 1);
    }
};

export const emit = (event, data = undefined) => {
    for (const listener of listeners) {
        if (listener.event === event) {
            listener.callback(data);
        }
    }
};

export const countListeners = () => listeners.length;

export default { on, off, emit, countListeners };

