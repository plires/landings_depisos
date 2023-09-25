import { useEffect, useRef } from 'react'

import './header.css'

const Header = () => {
  const headerElement = useRef()

  useEffect(() => {
    const handleScroll = () => {
      const scrollPosition = window.scrollY

      if (scrollPosition > 100) {
        headerElement.current.classList.add('fixed')
      } else {
        headerElement.current.classList.remove('fixed')
      }
    }

    window.addEventListener('scroll', handleScroll)

    return () => {
      window.removeEventListener('scroll', handleScroll)
    }
  }, [])

  return (
    <header className='transition' ref={headerElement}>
      <div className='content_logo transition'>
        <img
          className='img-fluid'
          src='/img/logo-depisos.png'
          alt='logo depisos.com'
        />
      </div>
    </header>
  )
}

export default Header
