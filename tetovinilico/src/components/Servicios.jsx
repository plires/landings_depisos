import Typewriter from 'typewriter-effect'

import './servicios.css'

const Servicios = () => {
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
        src='./img/tetovinilico/tilde.png'
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
    </div>
  )
}
export default Servicios
