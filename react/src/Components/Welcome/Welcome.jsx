import React from 'react';

const Welcome = ( { match } ) => {
    // Cogemos los params
    const { params } = match;
    console.log(params)
    if(params.parametro) {
        return (
            <h1>He recibido el parámetro: {params.parametro}</h1>
        )
    } else {
        return (
            <h1>No param match</h1>
        )
    }
}

export default Welcome