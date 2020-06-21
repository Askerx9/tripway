import React from "react"
import {DaysCount} from "../../utils/Days";
import pluralize from "../../utils/Pluralize";



export const PlanningCard = function ({planning}) {

    // console.log(planning)

    const backgroundImage = {backgroundImage: `url(${planning.imageName})`}
    const activity = planning.activity.map(activity => activity)
    const activitySentence = activity.length + " " + pluralize("activité", activity)
    const prices = activity.reduce((sum, {price}) => {
        return sum + price
    }, 0)

    return (
        <a href={"profile/" + planning.slug} className='planning-card' style={backgroundImage}>
            <div className="planning-card__header">
                <div>
                    <h3 className="planning-card__title">
                        <span>{planning.name}</span> <br />
                        <span>Planning de {DaysCount(planning.daysCount)}</span>
                    </h3>
                    <p className="planning-card__country">
                        {planning.name}
                    </p>
                </div>

                <ul className="planning-card__footer">
                    <li className="planning-card__info planning-card__info--activity">{activitySentence}</li>
                    <li className="planning-card__info planning-card__info--person">{planning.people} pers</li>
                    <li className="planning-card__info planning-card__info--budget">{Math.floor(prices)}€</li>
                </ul>
            </div>
        </a>
    )
}

export const PlanningCardLoading = function () {

    return (
        <a href="" className={'planning-card '}>
            <div className="planning-card__header">
                <div>
                    <h3 className="planning-card__title">
                        <span></span> <br />
                        <span></span>
                    </h3>
                    <p className="planning-card__country">

                    </p>
                </div>

                <ul className="planning-card__footer">
                    <li className="planning-card__info planning-card__info--activity"></li>
                    <li className="planning-card__info planning-card__info--person"></li>
                    <li className="planning-card__info planning-card__info--budget"></li>
                </ul>
            </div>
        </a>
    )
}