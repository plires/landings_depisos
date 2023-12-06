import './encastres.css'

const Encastres = () => {
  return (
    <section className='encastres container'>
      <div data-aos='fade-up' className='row'>
        <div className='col-md-6 offset-md-3'>
          <h2>Fácil encastre</h2>
          <p className='description'>
            Para una instalación más rápida y simple
          </p>
        </div>

        <div className='col-md-8 offset-md-2'>
          <div className='row'>
            <div className='col-6'>
              <img
                className='img-fluid'
                src='./img/tetovinilico/instalacion-teto-b.jpg'
                alt='instalacion de cielorrasos tetovinilicos b'
              />
            </div>
            <div className='col-6'>
              <img
                className='img-fluid'
                src='./img/tetovinilico/instalacion-teto-a.jpg'
                alt='instalacion de cielorrasos tetovinilicos a'
              />
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}

export default Encastres
