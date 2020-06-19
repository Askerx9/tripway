import React from "react";
import {PlanningCard, PlanningCardLoading} from "./PlanningCard";
import {Fetch} from "../Fetch";


export const PlanningsList = function ({plannings}) {
    return plannings.map(planning => <li className="planning__el" key={planning.id}><PlanningCard planning={planning} /></li>)
}

const LoadingCard = function () {
    return <>
        <li className="planning__el planning__el--fake">
            <PlanningCardLoading />
        </li>
        <li className="planning__el planning__el--fake">
            <PlanningCardLoading />
        </li>
        <li className="planning__el planning__el--fake">
            <PlanningCardLoading />
        </li>
    </>
}

export const PlanningsShow = function () {

    return (
        <section className={'container'}>
            <h1 className="subtitle subtitle--color">Tes plannings</h1>
            <ul className="planning">
                <Fetch method="get" endpoint="/plannings" loader={<LoadingCard />}>
                    {({data: plannings}) => <PlanningsList plannings={plannings} />}
                </Fetch>
            </ul>
        </section>
    )
}