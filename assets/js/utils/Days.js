import pluralize from "./Pluralize";

/**
 * @param {integer} days
 * @returns {number}
 * @constructor
 */
export const DaysToWeek = function (days) {
    return Math.round(days / 7);
}

/**
 * @param {integer} days
 * @returns {string}
 */
export function DaysCount(days) {
    if (days > 7) {
        const weeks = DaysToWeek(days);
        return weeks+ " " + pluralize('semaine', weeks)
        // return `${weeks} semaine${weeks > 1 ? "s" : ""}`
    }
    else {
        return days + " " + pluralize('jour', days)
        // return `${days} jour${days > 1 ? "s" : ""}`
    }

}