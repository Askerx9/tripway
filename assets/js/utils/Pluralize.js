/**
 *
 * @param {string} word
 * @param {int} count
 */
export const pluralize = function (word, count) {
    if(count > 1) {
        return word + "s"
    } else {
        return word
    }
}

export default pluralize;