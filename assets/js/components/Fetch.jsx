import React, {useState, useEffect} from 'react'
import {apiFetch} from "../utils/api";

export const Fetch = function ({method, endpoint, loader, children, ...props}) {

    const [data, setData] = useState(null)

    useEffect(function () {
        apiFetch(method, endpoint).then(setData)
    }, [])

    if (data === null) {
        return loader
    }

    return children({data, ...props})
}