// import { getFajaServicios } from './../utils/dataUtils'
import Typewriter from 'typewriter-effect'

import './servicios.css'

const Servicios = () => {
  // const fajaServicios = getFajaServicios('fajaServicios')
  const services = [
    'ENVÍOS A TODO EL PAÍS',
    'SEGUIMIENTOS ONLINE',
    'LOS MEJORES PRECIOS DEL MERCADO',
  ]

  return (
    <div className='content'>
      <img
        data-aos='fade-up'
        className='img-fluid'
        src='/img/tilde.png'
        alt='tilde'
      />
      <Typewriter
        data-aos='fade-up'
        options={{
          strings: services,
          autoStart: true,
          loop: true,
          delay: 50,
          deleteSpeed: 15,
          pauseFor: 3000,
        }}
      />
      {/* {fajaServicios.map(servicio => (
        <div data-aos='fade-up' key={servicio.id} className='col-md-4'>
          <div className='content'>
            <img
              className='img-fluid'
              src={servicio.img_src}
              alt={servicio.img_alt}
            />
            <p>{servicio.txt}</p>
          </div>
        </div>
      ))} */}
    </div>
  )
}
export default Servicios
