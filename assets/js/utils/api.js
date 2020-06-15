import {API_URL} from "../config";

/**
 *
 * @param {string} method
 * @param {string} endpoint
 * @param {object} options
 * @returns {Promise<void>}
 */
export async function apiFetch(method, endpoint, options) {
    const response = await fetch(API_URL + endpoint, {
        // credentials: 'includes',
        headers: {
            Accept: 'application/json'
        },
        method,
        ...options
    })

    const responseData = await response.json()

    if(response.ok) {
        return responseData
    } else {
        throw responseData
    }
}