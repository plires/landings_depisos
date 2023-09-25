import SlidePrincipal from './SlidePrincipal'
import SlideSecundarioSuperior from './SlideSecundarioSuperior'
import SlideSecundarioInferior from './SlideSecundarioInferior'

import './slide-griferias.css'

const SlideGriferia = () => {
  return (
    <section className='slide_griferias container-fluid'>
      <div className='row'>
        <div className='col-sm-12 col-md-7 p-0'>
          <SlidePrincipal interval='4500' />
        </div>

        <div className='d-none d-md-block col-md-5 p-0'>
          <SlideSecundarioSuperior interval='3800' />
          <SlideSecundarioInferior interval='2400' />
        </div>
      </div>
    </section>
  )
}

export default SlideGriferia
