import { useState } from 'react'

export default function Card(){
    var cont:number = 10
    const [Contador, setContador] = useState(0)
    const aumentar =() => {
        cont++;
        console.log('hola',cont)
        setContador (Contador+1)
        
        
    }
    return (
        <>
        <h1>Card{Contador}</h1>
        <button onClick={aumentar}>hola</button>

        </>
    )

}