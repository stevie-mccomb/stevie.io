import '@/prototypes/Array';
import { expect, test } from 'vitest';

test('random', async () => {
    expect(Array.prototype.random).toBeTruthy();

    const inValues = value => values.includes(value);
    const values = ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet'];

    let valuesMatched = [];
    for (let i = 0; i < 1000; ++i) {
        const value = values.random();
        const index = valuesMatched.indexOf(value);
        if (index < 0) valuesMatched.push(value);
        expect(value).toSatisfy(inValues);
    }

    expect(valuesMatched.length).toBe(values.length);
});
