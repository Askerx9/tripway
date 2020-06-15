import React, {useState, useEffect} from "react";
import {PlanningCard} from "./PlanningCard";
import {apiFetch} from "../../utils/api";

export const PlanningsShow = function () {

    const [plannings, setPlannings] = useState([])
    
    useEffect(function () {
        (async function () {
            const plannings = await apiFetch('GET', '/plannings')
            console.log(plannings)
            setPlannings(plannings)
        }())
    }, [])

    return (
        <section className={'container'}>
            <h1 className="subtitle subtitle--color">Tes plannings</h1>
            <ul className="planning">
                {plannings.map(planning => <li className="planning__el" key={planning.id}><PlanningCard planning={planning} /></li>)}
            </ul>
        </section>
    )

}