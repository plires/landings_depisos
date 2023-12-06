import SlidePrincipal from './SlidePrincipal'

import './slide-teto.css'

const SlideTeto = () => {
  return (
    <section className='slide_teto container-fluid'>
      <div className='row'>
        <div className='col-sm-12 p-0'>
          <SlidePrincipal interval='4500' />
        </div>
      </div>
    </section>
  )
}

export default SlideTeto
