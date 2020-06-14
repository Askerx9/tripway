import React from "react";
import {PlanningCard} from "./PlanningCard";

const plannings = [
    {id:1,name:'Japon', slug:'1234', country:'Japon', days_count: 14, start_at:'', finish_at:'' },
    {id:2,name:'Belgique', slug:'1234', country:'Belgique', days_count: 7, start_at:'', finish_at:'' },
    {id:3,name:'Mexique', slug:'1234', country:'Mexique', days_count: 23, start_at:'', finish_at:'' },
    ]


export const PlanningsShow = function () {

    return (
        <section className={'container'}>
            <h1 className="subtitle subtitle--color">Tes plannings</h1>
            <ul className="planning">
                {plannings.map(planning => <li className="planning__el" key={planning.id}><PlanningCard planning={planning} /></li>)}
            </ul>
        </section>
    )

}