import Servicios from './Servicios'
import './faja-servicios.css'

const FajaServicios = () => {
  return (
    <section className='faja container-fluid'>
      <div className='container'>
        <div className='row'>
          <div className='col-sm-12 col-md-10 offset-md-1'>
            <div className='row'>
              <Servicios />
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}
export default FajaServicios
