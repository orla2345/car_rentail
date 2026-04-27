import { useState } from 'react'
import Card from './components/card'

function App() {
  const [elementos, setElementos] = useState([]) as any
  const [nombre, setNombre] = useState("")

  const agregar = () => {
    setElementos([...elementos, nombre])
 
  }
  return (
    <>
    <h1>{nombre}</h1>
    <input type="text" value={nombre} onChange={(e) =>{ setNombre(e.target.value)} }/>
    <button onClick={agregar}>Agregar</button>
   
   {
    elementos.map((elemento: any) => {
    return <Card />
   } )
}
</>
  )
export default App
