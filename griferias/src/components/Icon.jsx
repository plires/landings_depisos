import './icon.css'

const Icon = ({ aplication }) => {
  return (
    <div className='content_icon'>
      <img
        className='img-fluid'
        src={aplication.img_src}
        alt={aplication.img_alt}
      />
      <p>{aplication.txt}</p>
    </div>
  )
}

export default Icon
