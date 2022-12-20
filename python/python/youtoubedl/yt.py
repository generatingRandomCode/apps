import sys
import os

def main():
    args = sys.argv[1:]

    #open file
    with open (args[0]) as f:
        line = f.readlines()
    f.close()
    line = [x.strip() for x in line if len(x.strip()) > 0]
    #curr_dir = os.path.dirname(os.path.realpath(__file__))
    #base_dir = "cd " + os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
    #print ("base    directory: ", base_dir)
    pfad= "cd /home/francois/Music/youtoubdl ; "
    command = "youtube-dl -ix --audio-format mp3 --prefer-ffmpeg "
    #[print(pfad + command + x) for x in line]
    [os.system(pfad + command  + x) for x in line]
    #print(command)
    #os.system(command)
    #pfad aendert sich.. muss vermieden  werden
    #os.system(base_dir)




if __name__ == "__main__":
    main()