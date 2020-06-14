import React from "react"
import DaysToWeek from "../../utils/DaysToWeek";

export const PlanningCard = function ({planning}) {


    return (
        <a href="" className='planning-card'>
            <div className="planning-card__header">
                <div>
                    <h3 className="planning-card__title">
                        <span>{planning.name}</span> <br />
                        <span>Planning {DaysToWeek(planning.days_count)} semaines</span>
                    </h3>
                    <p className="planning-card__country">
                        {planning.country}
                    </p>
                </div>

                <ul className="planning-card__footer">
                    <li className="planning-card__info planning-card__info--activity">7 villes</li>
                    <li className="planning-card__info planning-card__info--person">2 pers</li>
                    <li className="planning-card__info planning-card__info--budget">2000€</li>
                </ul>
            </div>
        </a>
    )
}