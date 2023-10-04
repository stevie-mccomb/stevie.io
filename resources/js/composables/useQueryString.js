import _ from 'lodash';
import { watch } from 'vue';

export const useQueryString = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, key) => searchParams.has(`${key}[]`) ? searchParams.getAll(`${key}[]`) : searchParams.get(key),
    set: (searchParams, key, value) => {
        if (Array.isArray(value)) {
            if (key.indexOf('[') < 0 || key.indexOf(']') < 0) key = `${key}[]`;
            searchParams.delete(key);
            for (const v of value) searchParams.append(key, v);
        } else {
            searchParams.set(key, value);
        }

        history.pushState(history.state, '', `${window.location.pathname}?${searchParams.toString()}`);

        return true;
    }
});

export const syncQueryParam = (key, ref) => watch(ref, value => useQueryString[key] = value);

export default useQueryString;
