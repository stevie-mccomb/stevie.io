import '@/prototypes/Number';
import { expect, test } from 'vitest';

test('clamp', async () => {
    expect(Number.prototype.clamp).toBeTruthy();

    const intValue = 320;
    const floatValue = 320.32;

    // min int
    expect(intValue.clamp(640, 960)).toBe(640);
    expect(floatValue.clamp(640, 960)).toBe(640);

    // min float
    expect(intValue.clamp(640.32, 960)).toBe(640.32);
    expect(floatValue.clamp(640.32, 960)).toBe(640.32);

    // max int
    expect(intValue.clamp(1, 160)).toBe(160);
    expect(floatValue.clamp(1, 160)).toBe(160);

    // max float
    expect(intValue.clamp(1, 160.32)).toBe(160.32);
    expect(floatValue.clamp(1, 160.32)).toBe(160.32);

    // within range
    expect(intValue.clamp(0, 960)).toBe(intValue);
    expect(floatValue.clamp(0, 960)).toBe(floatValue);
});
