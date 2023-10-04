import { countDecimalDigits, randomBoolean, randomFloat, randomInt } from '@/helpers/math';
import { expect, test } from 'vitest';

test('count decimal digits', async () => {
    expect(countDecimalDigits(1)).toBe(0);
    expect(countDecimalDigits(1.00)).toBe(0);

    expect(countDecimalDigits(1.32)).toBe(2);
    expect(countDecimalDigits(1.3216)).toBe(4);
    expect(countDecimalDigits(1.32161234)).toBe(8);
});

test('random boolean', async () => {
    const isBoolean = b => (b === true || b === false);

    let foundTrue = false;
    let foundFalse = false;
    for (let i = 0; i < 1000; ++i) {
        const value = randomBoolean();
        if (!foundTrue && value === true) foundTrue = true;
        if (!foundFalse && value === false) foundFalse = true;
        expect(value).toSatisfy(isBoolean);
    }

    expect(foundTrue).toBe(true);
    expect(foundFalse).toBe(true);
});

test('random float', async () => {
    const defaults = randomFloat();
    expect(defaults).toBeGreaterThanOrEqual(0.0);
    expect(defaults).toBeLessThanOrEqual(1.0);

    const withPrecision = randomFloat(0.0, 1.0, 2);
    expect(withPrecision).toBeGreaterThanOrEqual(0.0);
    expect(withPrecision).toBeLessThanOrEqual(1.0);
    expect(countDecimalDigits(withPrecision)).toBe(2);

    const withRange = randomFloat(16, 32);
    expect(withRange).toBeGreaterThanOrEqual(16);
    expect(withRange).toBeLessThanOrEqual(32);
});

test('random int', async () => {
    const defaults = randomInt();
    expect(Number.isInteger(defaults)).toBe(true);
    expect(defaults).toBeGreaterThanOrEqual(1);
    expect(defaults).toBeLessThanOrEqual(999999);

    const withRange = randomInt(16, 32);
    expect(Number.isInteger(withRange)).toBe(true);
    expect(withRange).toBeGreaterThanOrEqual(16);
    expect(withRange).toBeLessThanOrEqual(32);
});
